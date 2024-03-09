<?php include './app/views/components/head.php' ?>
<body>
    <div id="wrap-container" class="">
        <main id="container">
        <?php include './app/views/pages/' . $data['page'] . '.php'; ?>
        </main>
    </div>
</body>
</html>