<?php include './app/views/components/head.php'; ?>
<body>
    <div id="wrap-container" class="">
        <?php include './app/views/components/siderbar_admin.php'; ?>
        <main class="content">
            <?php include './app/views/components/header_admin.php'; ?>
            <div class="px-4 pt-4">
                <?php include './app/views/pages/' . $data['page'] . '.php'; ?>
            </div>
            <?php include './app/views/components/footer_admin.php'; ?>
        </main>
    </div>
    <!-- <script src="./public/js/permission.js"></script> -->
</body>
</html>
