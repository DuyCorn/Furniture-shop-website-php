<?php
session_start();
require_once 'config.php';
require_once "include/layout/header.php"; 
?>

<div class="container">
    <h1 class="text-center mb-4">Về Chúng Tôi</h1>

    <p>Trang web bán nội thất này là đồ án môn học của Ngô Hoàng Duy, sinh viên năm 3 Trường ĐH Công thương TPHCM, chuyên ngành công nghệ phần mềm. 
    Đồ án này được thực hiện với mục tiêu mở rộng kiến thức về phát triển web bằng ngôn ngữ PHP, đồng thời ứng dụng kiến thức vào thực tế thông qua việc xây dựng một trang web thương mại điện tử.</p>

    <p>Trang web này được phát triển bằng PHP và chạy trên phần mềm Ampps. 
    Nó cung cấp một nền tảng trực tuyến để mua bán các sản phẩm nội thất đa dạng, từ bàn ghế, giường ngủ, tủ quần áo đến các phụ kiện trang trí.</p>

    <div class="row mt-4">
        <div>
            <h3>Mục tiêu của đồ án:</h3>
            <ul>
                <li>Nâng cao kỹ năng lập trình PHP.</li>
                <li>Thực hành kiến thức về phát triển web thương mại điện tử.</li>
                <li>Tạo ra một sản phẩm web hoàn chỉnh và có thể sử dụng.</li>
            </ul>
        </div>
    </div>

    <p class="mt-4">Trang web này vẫn đang trong quá trình phát triển và sẽ được cập nhật thêm nhiều tính năng mới trong tương lai. 
    Chúng tôi rất mong nhận được phản hồi và góp ý từ phía người dùng để trang web ngày càng hoàn thiện hơn.</p>
</div>

<?php require_once "include/layout/footer.php"; ?>