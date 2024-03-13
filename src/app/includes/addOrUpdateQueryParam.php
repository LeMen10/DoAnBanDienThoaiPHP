<?php
    // Hàm thêm tham số vào URL nếu chưa tồn tại
    function addOrUpdateQueryParam($url, $paramName, $paramValue) {
        $urlParts = parse_url($url);
        parse_str($urlParts['query'], $queryParams);

        // Kiểm tra xem tham số đã tồn tại trong URL chưa
        if (array_key_exists($paramName, $queryParams)) {
            // Nếu đã tồn tại, cập nhật giá trị của tham số
            $queryParams[$paramName] = $paramValue;
        } else {
            // Nếu chưa tồn tại, thêm tham số vào URL
            $queryParams[$paramName] = $paramValue;
        }

        // Xây dựng lại query string và trả về URL mới
        $newQueryString = http_build_query($queryParams);
        return $urlParts['path'] . '?' . $newQueryString;
    }
