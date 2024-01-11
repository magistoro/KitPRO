<script>
document.addEventListener("DOMContentLoaded", function() {
// Получаем текущую тему из localStorage
const currentTheme = localStorage.getItem('theme');

// Проверяем текущую тему
var successMessage = '{{ session('success') }}';
var infoMessage = '{{ session('info') }}';
var dangerMessage = '{{ session('danger') }}';

if (successMessage) {
  if (currentTheme === 'dark-mode') {
    Swal.fire({
      title: successMessage,
      icon: 'success',
      timer: 3000,
      position: 'top-end',
      toast: true,
      showConfirmButton: false,
      background: "#454d55",
    });
  } else {
    Swal.fire({
      title: successMessage,
      icon: 'success',
      timer: 3000,
      position: 'top-end',
      toast: true,
      showConfirmButton: false
    });
  }
}

if (infoMessage) {
  if (currentTheme === 'dark-mode') {
    Swal.fire({
      title: infoMessage,
      icon: 'info',
      timer: 3000,
      position: 'top-end',
      toast: true,
      showConfirmButton: false,
      background: "#454d55",
    });
  } else {
    Swal.fire({
      title: infoMessage,
      icon: 'info',
      timer: 3000,
      position: 'top-end',
      toast: true,
      showConfirmButton: false
    });
  }
}

if (dangerMessage) {
  if (currentTheme === 'dark-mode') {
    Swal.fire({
      title: dangerMessage,
      icon: 'error',
      timer: 3000,
      position: 'top-end',
      toast: true,
      showConfirmButton: false,
      background: "#454d55",
    });
  } else {
    Swal.fire({
      title: dangerMessage,
      icon: 'error',
      timer: 3000,
      position: 'top-end',
      toast: true,
      showConfirmButton: false
    });
  }
}
});
</script>