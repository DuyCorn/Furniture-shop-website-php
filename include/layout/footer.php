</div>
<footer class="footer mt-auto py-3">
        <div class="container text-center footer-info">
            <span>© 2001210231-Ngô Hoàng Duy</span>
            <p>Địa chỉ: 140 Lê Trọng Tấn, phường Tây Thạnh, quận Tân Phú, TP.HCM</p>
            <p>Email: ngohoangduy0103@gmail.com</p>
            <p>Số điện thoại: 0703560881</p>
            <div class="mt-3">
                <a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.twitter.com/" class="ms-4"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/" class="ms-4"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/" class="ms-4"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        <div class="footer-map">
            <iframe src="https://www.google.com/maps?q=140+L%C3%AA+Tr%E1%BB%8Dng+T%E1%BA%A5n,+T%C3%A2n+Ph%C3%BA,+H%E1%BB%93+Ch%C3%AD+Minh,+Vi%E1%BB%87t+Nam&output=embed" width="600" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            var sortType = urlParams.get('sort');
            $('#sortSelect').val(sortType);
            $('#sortSelect').change(function() {
                var sortType = $(this).val();
                window.location.href = window.location.pathname + '?sort=' + sortType;
            });
        });
    </script>
</body>
</html>
