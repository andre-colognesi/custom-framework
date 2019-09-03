<script>
    document.addEventListener("DOMContentLoaded",()=>{
        let links = document.getElementsByTagName("a");

        for(let i = 0; i < links.length; i++){
            links[i].addEventListener("mouseover",()=>{
                links[i].cursor.style = "pointer";
            })
        }
    })
</script>
</body>
</html>