<script>
    function togglePassword(fieldId, button) {
        const field = document.getElementById(fieldId);
        const isPassword = field.type === 'password';
        field.type = isPassword ? 'text' : 'password';

        const eyeIcon = button.querySelector('.eye-icon');
        const eyeSlashIcon = button.querySelector('.eye-slash-icon');

        if (isPassword) {
            eyeIcon.classList.add('hidden');
            eyeSlashIcon.classList.remove('hidden');
        } else {
            eyeIcon.classList.remove('hidden');
            eyeSlashIcon.classList.add('hidden');
        }
    }
</script>