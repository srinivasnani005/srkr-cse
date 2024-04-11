<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="modal-header">
            <h2>NAAC Grade: A+</h2>
        </div>
        <div class="modal-body">
            <!-- Add image or any other content here -->
            <img src="naac.jpg" alt="">
        </div>
    </div>
</div>



<script>
    
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById('modal');
    const link = document.querySelector('.download-btn');

    link.addEventListener('click', function(event) {
        event.preventDefault();
        modal.style.display = 'block';
    });

    const closeBtn = document.querySelector('.close');
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
</script>