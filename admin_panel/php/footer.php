</div>

<script>
  var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
  var screenHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

  // console.log("Screen width: " + screenWidth);
  // console.log("Screen height: " + screenHeight);
  // console.log(typeof(screenWidth));
  // console.log(typeof(screenHeight));
  // var w = (screenWidth - 100).toString() + 'px';
  // var h = (screenHeight - 60).toString() + 'px';
  // console.log(w + ', ' + typeof(w));
  // console.log(h + ', ' + typeof(h));
  // console.log('continer width  ' + w + 'px');
  // console.log('continer height ' + h + 'px');

  const continer = document.getElementById('continer');
  continer.style.width  = (screenWidth - 100).toString() + 'px';
  continer.style.height = (screenHeight - 60).toString() + 'px';

  const con = document.getElementById('in_content');
  con.style.height = (screenHeight - 60).toString() + 'px';

</script>
</body>
</html>