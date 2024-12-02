
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
    <?php        
        // Vérifier si un message est stocké dans la session success
        if (isset($_SESSION['success'])) {  
            ?>
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="myToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">Notification</strong>
                            <small class="text-muted">Just now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            <?= $_SESSION['success'] ?>
                        </div>
                    </div>
                </div>
            <?php
        } unset($_SESSION['success']);
    ?>
    
    
    <?php
        // Vérifier si un message est stocké dans la session error
        if (isset($_SESSION['error'])) {  
            ?>
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="myToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">Notification</strong>
                            <small class="text-muted">Just now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            <?= $_SESSION['error'] ?>
                        </div>
                    </div>
                </div>
            <?php
        }unset($_SESSION['error']);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var toastEl = document.getElementById('myToast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    </script>