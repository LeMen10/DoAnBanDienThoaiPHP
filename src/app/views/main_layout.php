<?php include './app/views/components/head.php'; ?>
<body>
    <div id="wrap-container" class="">
        <div id="toast" class="toast-message-wrapper"></div>
        <?php include './app/views/components/header.php'; ?>
        <main id="container">
            <?php include './app/views/pages/' . $data['page'] . '.php'; ?>
        </main>
        <?php include './app/views/components/footer.php'; ?>
    </div>
</body>
</html>
