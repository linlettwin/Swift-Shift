<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>
    <p style="background: #89CFF0;"  id="1" onclick="changeColor1()">&nbsp1</p>
    <p style="background: #89CFF0;"  id="2" onclick="changeColor2()">&nbsp2</p>
    <p style="background: #89CFF0;"  id="3" onclick="changeColor3()">&nbsp3</p>
    </form>
    <script type="text/javascript">
  
        function changeColor1()
        {
        //window.alert("You clicked"+btn);
        
        document.getElementById("1").style.background='#0BCE07';
            
        
        }
        function changeColor2()
        {
        //window.alert("You clicked"+btn);
        
        document.getElementById("2").style.background='#0BCE07';
            
        
        }
        function changeColor3()
        {
        //window.alert("You clicked"+btn);
        
        document.getElementById("3").style.background='#0BCE07';
            
        
        }
  
</script>
</body>
</html>