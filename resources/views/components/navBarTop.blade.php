<link rel="stylesheet" href="{{ asset('css/navBarTop.css') }}">

<header class="topNav">

<button type="button" id = "backBtn">
    Back
</button>

<h1 class="storeName">
    Rj Store
</h1>

</header>
<script>
    const backBtn = document.querySelector("#backBtn");

    if(backBtn){
        backBtn.addEventListener('click', function(){
            history.back();
        });
    }
</script>
