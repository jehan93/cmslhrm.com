<script>
    var i = 0;
    function buttonClick() {
        i++;
        document.getElementById('inc').value = i;
    }
    function buttonClickDeduct() {
        i--;
        document.getElementById('inc').value = i;
    }
</script>
<button onclick="buttonClick();">+</button>
<button onclick="buttonClickDeduct()();">-</button>
<input type="text" id="inc" value="0"></input>