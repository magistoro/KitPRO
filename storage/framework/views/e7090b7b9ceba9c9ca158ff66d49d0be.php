<script>
document.addEventListener("DOMContentLoaded", function() {
// Получаем текущую тему из localStorage
const currentTheme = localStorage.getItem('theme');

// Проверяем текущую тему
if (currentTheme === 'dark-mode') {
    // Добавьте CSS-класс всплывающему окну для темной темы
    var successMessage = '<?php echo e(session('success')); ?>';
    if (successMessage) {
      Swal.fire({
        title: `${successMessage}`,
        icon: 'success',
        timer: 3000,
        position: 'top-end', // изменить положение на правый верхний угол
        toast: true, // включить режим toast
        showConfirmButton: false, // скрыть кнопку "Ок"
        background: "#454d55",
      });
  }
 } else {
    // Добавьте CSS-класс всплывающему окну для светлой темы
    var successMessage = '<?php echo e(session('success')); ?>';
      if (successMessage) {
        // Показать SweetAlert2
        Swal.fire({
            title: `${successMessage}`,
            icon: 'success',
            timer: 3000,
            position: 'top-end', // изменить положение на правый верхний угол
            toast: true, // включить режим toast
            showConfirmButton: false // скрыть кнопку "Ок"
        });
      }
}
});
</script><?php /**PATH C:\Users\maksi\Desktop\Мои_сайты\kitprotv\resources\views/layouts/statusPopUp.blade.php ENDPATH**/ ?>