<?php
function showNotification($message, $type) {
    $className = ($type === 'error') ? 'error-notification' : 'success-notification';
    echo '<div class="notification-container ' . $className . '">';
    echo '<div class="notification-content">';
    echo $message;
    echo '</div>';
    echo '</div>';
}

?>

<style>
/* Notification styles */
.notification-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    max-width: 300px; /* Limiting width for responsiveness */
    animation: slideInRight 0.5s ease-in-out, fadeOut 0.5s ease-in-out 5s forwards;
}

.notification-content {
    background-color: #f8d7da; /* Error message background */
    color: #721c24; /* Error message text color */
    border: 1px solid #f5c6cb; /* Error message border color */
    border-radius: 5px;
    padding: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.success-notification .notification-content {
    background-color: #d4edda; /* Success message background */
    color: #155724; /* Success message text color */
    border-color: #c3e6cb; /* Success message border color */
}

/* Animation keyframes */
@keyframes slideInRight {
    from {
        transform: translateX(100%);
    }
    to {
        transform: translateX(0);
    }
}
@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}
</style>
