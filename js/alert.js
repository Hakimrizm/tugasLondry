const alert = document.getElementById('#alert');
alert.addEventListener('click', function(){
  Swall.fire({
    title: 'Hello world',
    text: 'Latihan Sweetalert',
    type: 'warning'
  });
});

<script src="sweetalert2.all.min.js"></script>