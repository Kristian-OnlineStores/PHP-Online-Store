$.ajax({
    url: 'setData.php',
    type: 'POST',
    data: { action: 'set_status' },  // липсваше data обект
    success: function(response) {
        window.location.href = 'redirect-url';  // пренасочване
        console.log(response);  // логване в конзолата
    },
    error: function() {
        window.location.href = 'error.html';  // пренасочване при грешка
    }
});