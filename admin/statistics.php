<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('../db.inc.php'); //引用資料庫連線

$sqlTotal = "SELECT count(1) FROM `orders`"; //SQL 敘述
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0]; //取得總筆數
$numPerPage = 5; //每頁幾筆
$totalPages = ceil($total/$numPerPage); // 總頁數
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; //目前第幾頁
$page = $page < 1 ? 1 : $page; //若 page 小於 1，則回傳 1

?>
<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>後台統計資料</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    //付款方式變數
    let atmNumber = 0;
    let creditNumber= 0;
    let deliverNumber= 0;
    let conviNumber= 0;
    //訂單金額變數
    let lessNumber = 0;
    let midNumber= 0;
    let midlargeNumber= 0;
    let largeNumber= 0;
    //種類陣列
    var catArr =[];
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart2);

      $.ajax({
        method: "GET",
        url: "orders.json",
        dataType: "json"
        }).done(function(data) {
        // console.log(data)
            data.forEach(function(item){
                let paymentMethod = item.paymentMethod
                let totalPrice = item.totalPrice
              
                switch(paymentMethod) {
                    case'ATM轉帳' :
                        atmNumber += 1;
                        break;
                    case'信用卡':
                        creditNumber += 1;
                        break;
                    case'貨到付款':
                        deliverNumber += 1;
                        break;
                    case'超商付款':
                        conviNumber += 1;
                        break;

                    default: 
                        break;
                }
                if(totalPrice < 300){
                    lessNumber+=1
                }else if(totalPrice > 300 && totalPrice < 800){
                    midNumber+=1

                }else if(totalPrice > 800 && totalPrice < 1000){
                    midlargeNumber+=1

                }else if(totalPrice > 1000 ){
                    largeNumber+=1

                }

                // catArr.push([paymentMethod,totalPrice])
                 
            })

        })          
        .fail(function() {
            alert( "json is not exist" );
        }).always(function() {
            // alert( "complete" );
            });

      // 第一個圖表.
      function drawChart() {
        
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['ATM轉帳', atmNumber],
          ['信用卡', creditNumber],
          ['貨到付款', deliverNumber],
          ['超商付款', conviNumber]
        ]);

        // Set chart options
        var options = {'title':'訂單付款方式比例',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
      // 第二個圖表.
      function drawChart2() {
      var data = google.visualization.arrayToDataTable([
        ["金額區間", "orders", { role: "style" } ],
        ["300元以下", lessNumber, "#b87333"],
        ["$300-$800", midNumber, "silver"],
        ["$800-$1000", midlargeNumber, "red"],
        ["1000元以上", largeNumber, "gold"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "訂單金額區間",
        width: 400,
        height: 300,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart2 = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart2.draw(view, options);
  }
    </script>
    <style>
    .border {
        border: 1px solid;
    }
    img.payment_type_icon{
        width: 50px;
    }
    </style>
</head>
<body>
<?php require_once('./templates/title.php'); ?>
<div class="col-md-10">
<div class="search-bar">
<h3>統計列表</h3>
<div class="d-flex allCharts">
<div id="chart_div"></div>
<div id="columnchart_values"></div>
</div>


<form action="searchOrders.php" method="POST" entype= "multipart/form-data">
<table class="search table table-stripe table-hover">
    <tr>
    <td>
    <label for="searchOrders">訂單資料</label>
    <select name="searchOrders" id="searchOrders">
        <option value="orderId">訂單編號</option>
        <option value="username">用戶名稱</option>
        <option value="paymentMethod">付款方式</option>
        <option value="paymentStatus">付款狀態</option>
    </select>
    <input name="search" type="text" placeholder="訂單關鍵字搜尋" autocomplete="off">
<input type="submit" value="搜尋">
    </td>
    </tr>
</table>
</form>
</div>
<br>
<form name="myForm" method="POST" action="./deleteOrder.php">
    <table class="border table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" class="border">
                    <div class="p-2 px-3 text-uppercase">訂單編號</div>
                </th>
                <th scope="col" class="border">
                    <div class="p-2 px-3 text-uppercase">用戶名稱</div>
                </th>
                <th scope="col" class="border">
                    <div class="py-2 text-uppercase">付款方式</div>
                </th>
                <th scope="col" class="border">
                    <div class="py-2 text-uppercase">商品名稱</div>
                </th>
                <th scope="col" class="border">
                    <div class="py-2 text-uppercase">商品種類</div>
                </th>
                <th scope="col" class="border">
                    <div class="py-2 text-uppercase">單價</div>
                </th>
                <th scope="col" class="border">
                    <div class="py-2 text-uppercase">數量</div>
                </th>
                <th scope="col" class="border">
                    <div class="py-2 text-uppercase">總金額</div>
                </th>
                <th scope="col" class="border">
                    <div class="py-2 text-uppercase">付款狀態</div>
                </th>
                <th scope="col" class="border">
                    <div class="py-2 text-uppercase">訂單時間</div>
                </th>


                <th scope="col" class="border">
                    <div class="py-2 text-uppercase">功能</div>
                </th>


            </tr>
        </thead>
        <tbody>
        <?php
        $sqlOrder = "SELECT * FROM orders  ORDER BY created_at  DESC LIMIT  ? , ? ";

        //設定繫結值
        $arrParam = [($page - 1) * $numPerPage, $numPerPage];
        
        $stmtOrder = $pdo->prepare($sqlOrder);
        $stmtOrder->execute($arrParam);


        if($stmtOrder->rowCount() > 0){
            $arrOrders = $stmtOrder->fetchAll(PDO::FETCH_ASSOC);
            for($i = 0; $i < count($arrOrders); $i++) {
        ?>
            <tr>
                <th scope="row" class="border"><?php echo $arrOrders[$i]["orderId"] ?></th>
                <td class="border"><?php echo $arrOrders[$i]["ship_name"] ?></td>
                <td class="border"><?php echo $arrOrders[$i]["paymentMethod"] ?></td>
                <td class="border">
                <?php
                $sqlItemList = "SELECT `order_lists`.`checkPrice`,`order_lists`.`checkQuantity`,`order_lists`.`checkSubtotal`,
                                        `items`.`itemName`,`category`.`categoryName`
                                FROM `order_lists` 
                                INNER JOIN `items`
                                ON `order_lists`.`itemId` = `items`.`itemId`
                                INNER JOIN `category` 
                                ON `items`.`itemCategoryId` = `category`.`categoryId`
                                WHERE `order_lists`.`orderId` = ? 
                                ORDER BY `order_lists`.`orderListId` ASC";
                $stmtItemList = $pdo->prepare($sqlItemList);
                $arrParamItemList = [
                    $arrOrders[$i]["orderId"]
                ];
                $stmtItemList->execute($arrParamItemList);

                if($stmtItemList->rowCount() > 0) {
                    $arrItemList = $stmtItemList->fetchAll(PDO::FETCH_ASSOC);
                    for($j = 0; $j < count($arrItemList); $j++) {
                       
                    
                ?>
                
                    <p><?php echo $arrItemList[$j]["itemName"] ?></p>
                    <!-- <p>商品種類: <?php echo $arrItemList[$j]["categoryName"] ?></p>
                    <p>單價: <?php echo $arrItemList[$j]["checkPrice"] ?></p>
                    <p>數量: <?php echo $arrItemList[$j]["checkQuantity"] ?></p>
                    <p>小計: <?php echo $arrItemList[$j]["checkSubtotal"] ?></p>
                    <br /> -->
                <?php
                    }
                }
                ?>
                </td>
                <td class="border">
                    <?php
                        for($j = 0; $j < count($arrItemList); $j++) {
                    ?>
                        <p><?php echo $arrItemList[$j]["categoryName"] ?></p>
                    <?php
                    }
                    ?>
                </td>

                <td class="border">
                    <?php
                        for($j = 0; $j < count($arrItemList); $j++) {
                    ?>
                        <p><?php echo $arrItemList[$j]["checkPrice"] ?> $NTD</p>
                    <?php
                    }
                    ?>
                </td>

                <td class="border">
                    <?php
                        for($j = 0; $j < count($arrItemList); $j++) {
                    ?>
                        <p><?php echo $arrItemList[$j]["checkQuantity"] ?> 件</p>
                    <?php
                    }
                    ?>
                </td>

                <!-- <td class="border">
                    <?php
                        for($j = 0; $j < count($arrItemList); $j++) {
                    ?>
                        <p><?php echo $arrItemList[$j]["checkSubtotal"] ?> $NTD</p>
                    <?php
                    }
                    ?>
                </td> -->
                <td class="border"><?php echo $arrOrders[$i]["totalPrice"] ?> $NTD</td>
                <td class="border"><?php echo $arrOrders[$i]["paymentStatus"] ?> </td>
                <td class="border"><?php echo $arrOrders[$i]["created_at"] ?> </td>
                
                <td class="border">
                    <a class='btn mano_edit fas fa-edit' href="./editOrder.php?orderId=<?php echo $arrOrders[$i]["orderId"] ?>" class="text-dark">編輯</a>
                    <a class='btn mano_delete fas fa-trash-alt' href="./deleteOrder.php?orderId=<?php echo $arrOrders[$i]["orderId"] ?>" class="text-dark">刪除</a>
                </td>
            </tr>
        <?php
            }
        }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="border" colspan="9">
                <?php for($i = 1; $i <= $totalPages; $i++){ ?>
                    <a href="?page=<?=$i?>"><?= $i ?></a>
                <?php } ?>
                </td>
            </tr>            
        </tfoot>

    </table>
</div>

</form></div>
</body>
</html>