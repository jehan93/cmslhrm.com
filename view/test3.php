<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Demo GetSelectOptionData</title>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/layout.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="../JQuery/jquery-3.2.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <form name="demoForm">
        <select name="demoSelect" id="demoSelect" onchange="showData()">
            <option value="zilch">Select:</option>
            <option value="A">Option 1</option>
            <option value="B">Option 2</option>
            <option value="C">Option 3</option>
        </select>
        <input class="btn btn-primary btn-block btn_press" value="Press" type="button"/>
        
    </form>
    
    <p id="firstP">&nbsp;</p>
    <p id="secondP">&nbsp;</p>
    <p id="thirdP">&nbsp;</p>

    
	
</body>
</html>
<script>
    var theSelect = demoForm.demoSelect;
        var firstP = document.getElementById('firstP');
        var secondP = document.getElementById('secondP');
        var thirdP = document.getElementById('thirdP');
        
        $(document).on('click','.btn_press',function(){
            var text = theSelect[theSelect.selectedIndex].text;
            alert(text);
        });
        
    function showData() {
        
        var text = theSelect[theSelect.selectedIndex].text;
        firstP.innerHTML = ('This option\'s index number is: ' + theSelect.selectedIndex + ' (Javascript index numbers start at 0)');
        secondP.innerHTML = ('Its value is: ' + theSelect[theSelect.selectedIndex].value);
        thirdP.innerHTML = ('Its text is: ' + text);
    }
    </script>