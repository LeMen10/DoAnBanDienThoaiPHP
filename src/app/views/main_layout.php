<?php include './app/views/components/head.php'; ?>
<body>
    <div id="wrap-container" class="">
        <?php include './app/views/components/header.php'; ?>
        <main id="container">
        <?php include './app/views/pages/' . $data['page'] . '.php'; ?>
        </main>
        <?php include './app/views/components/footer.php'; ?>
    </div>
    <!-- <script src="./public/js/permission.js"></script> -->
</body>
</html>
