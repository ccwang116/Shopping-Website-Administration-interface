<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* 顏色專區 勿動 */
        :root {
            --mainColor: #016D1B;
            --secondColor: #A1CD2E;
            --thirdColor: #996145;
            --bgColor: rgb(255, 243, 199);
            --checkColor:#78962E;
            --editColor:#D29454;
            --deleteColor:#CE5145;
        }
        
        /* 網頁呈現相關 */
        .container {
            max-width: 960px;
            margin: 0 auto;
        }

        .d-flex {
            display: flex;
        }
        h3{
            margin-top:88px;
        }
        /* 網頁呈現相關end */

        /* 樣式相關開始 */

        .manoBorder {
            border: 2px solid var(--mainColor);
            border-radius: 15px;
        }

        .bgcolor1 {
            background-color: var(--bgColor);
        }
        .bgcolor2 {
            background-color: var(--secondColor);
        }
        .bgcolor3 {
            background-color: var(--thirdColor);
        }

        .mano_dark {
            background-color: var(--mainColor);
            color: #fff;

        }
        
        .mano_light {
            color: var(--mainColor);
            border: 2px solid var(--mainColor);
        }

        .mano_check {
            background-color: var(--checkColor);
            color: #fff;

        }
        .mano_edit {
            background-color: var(--editColor);
            color: #fff;

        }
        .mano_delete {
            background-color: var(--deleteColor);
            color: #fff;

        }
        /* 樣式結束 */

        /* 導覽列開始 */
        .navbar{
            justify-content: space-between;
            background-color: var(--mainColor);
            color: #fff;
        }            
        nav .btn,nav .btn:hover{
            background-color: var(--mainColor);
            color: #fff;
            /* border: 1px solid  #fff; */
        }
        
        .dropdown{
            background-color: var(--mainColor);
            /* border-right:1px solid yellow; */
        }
        .dropdown-menu a,.dropdown-menu a:hover{
            color: var(--mainColor);
        }
        /* 導覽列結束 */

        /* 清單相關開始 */
                /* 參考教學 */
                .treeview 
                .list-group-item{cursor:pointer}
                .treeview .node-disabled{color:silver;cursor:not-allowed}
                /* .node-treeview1:not(.node-disabled):hover{background-color:#F5F5F5;}  */
                /* 參考教學結束 */
        .treeview a,.treeview a:hover,.treeview a:visited{
            color: var(--mainColor);
        }
        .list-group-item{
            color:var(--mainColor);
            border-style:none;
        }
        .list-group2{
            color: #fff;
            border-style:none;
            background:var(--mainColor);  
        }
        /* nav  a,nav a:hover{
            color: #fff;
        }  */
       
        /* 清單相關結束 */
        .table {
            width:100%;

        }
        thead{
            background-color: var(--secondColor);
            /* color: #fff; */
        }
        body{
            font-family:微軟正黑體;
        }
        table td.shrink { 
         white-space:nowrap ;
        } 
        table td.expand { 
            width: 99% ;
        } 
        .logout{
            width:100%;
            margin-top:360px;

        }
        .logout a{
            width:100%;
            display:block;
        }
        .list-title{
            font-size:14pt;
        }
    </style>
</head>
<body >
<div class="row">
<div class="col-md-2 ">
<nav class="navbar flex-column fixed-left h-100 ">
<div class="list-group ">
<a class="navbar-brand text-white mb-5" href="#">抹の後台</a>
<!-- <div>|</div> -->
<a href="./statistics.php" class="list-group-item list-group2 list-group-item-action fab fa-envira">統計資料</a>

  <div class="list-title  fas fa-mug-hot mb-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    商品管理
  </div>
    <a href="./category.php" class="fab fa-envira list-group-item list-group2 list-group-item-action">編輯類別</a>

    <a href="./admin.php" class="list-group-item list-group2 list-group-item-action fab fa-envira">商品列表</a>
    <a href="./new.php" class="list-group-item list-group2 list-group-item-action fab fa-envira">新增商品</a>
<!-- <div>|</div> -->
<!-- <a href="./admin.php" class="fab fa-envira">商品列表</a> |  -->
<!-- <a href="./new.php" class="fab fa-envira">新增商品</a> |  -->
  <div class="list-title fas fa-mug-hot mb-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disable>
    課程管理
  </div>
    <a href="./admin.course.search.php" class="list-group-item list-group2 list-group-item-action fab fa-envira">課程列表</a>
    <a href="./new.course.php" class="list-group-item list-group2 list-group-item-action fab fa-envira">新增課程</a>
<!-- <div>|</div> -->
<!-- <a href="./admin.course.php" class="fab fa-envira">課程列表</a> | -->
<!-- <a href="./new.course.php" class="fab fa-envira">新增課程</a> | -->
<a href="./orders.php" class="fab fa-envira list-group-item list-group2 list-group-item-action">訂單一覽</a>
<!-- <div>|</div> -->
<a href="./itemTracking.php" class="fab fa-envira list-group-item list-group2 list-group-item-action">商品追蹤管理</a>
<!-- <div>|</div> -->

  <div class="list-title  fas fa-mug-hot mb-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    行銷管理
  </div>
    <a href="./market.php" class="list-group-item list-group2 list-group-item-action fab fa-envira">活動列表</a>
    <a href="./newMarket.php" class="list-group-item list-group2 list-group-item-action fab fa-envira">新增活動</a>
  <div class="list-title  fas fa-mug-hot mb-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    會員管理
  </div>
  
  <a href="./member_Search.php" class="list-group-item list-group2 list-group-item-action fab fa-envira">搜尋會員</a>
    <a href="./member_admin.php" class="list-group-item list-group2 list-group-item-action fab fa-envira">會員列表</a>
    <a href="./member_new.php" class="list-group-item list-group2 list-group-item-action fab fa-envira">新增會員</a>
<a href="./paymentType.php" class="fab fa-envira list-group-item list-group2 list-group-item-action">編輯付款方式</a>
<!-- <div>|</div> -->
<div class="logout ">
<a href="../logout.php?logout=1" class="text-white text-center">登出</a>
</div>
</div>
</nav>
<br>
<br>
 <!-- Required Boostrap  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>     
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</div>
</body>
