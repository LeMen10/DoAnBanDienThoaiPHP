<?php include './app/views/components/head.php' ?>
<body>
    <div id="wrap-container" class="">
        <div id="toast" class="toast-message-wrapper"></div>
        <main id="container">
            <?php include './app/views/pages/' . $data['page'] . '.php'; ?>
        </main>
    </div>
</body>
</html>