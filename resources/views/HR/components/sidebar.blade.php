<div id="promotionSidebar">

    <h5 class="mb-3">
        <i class="fas fa-list"></i> Navigation
    </h5>

    <a href="#generalSection" class="sidebar-link active">
        <i class="fas fa-user"></i>
        General Details
    </a>

    <a href="#teachingSection" class="sidebar-link">
        <i class="fas fa-book"></i>
        Teaching
    </a>

    <a href="#publicationSection" class="sidebar-link">
        <i class="fas fa-file-alt"></i>
        Publications
    </a>

    <a href="#projectSection" class="sidebar-link">
        <i class="fas fa-project-diagram"></i>
        Projects
    </a>

    <a href="#patentSection" class="sidebar-link">
        <i class="fas fa-lightbulb"></i>
        Patents
    </a>

    <a href="#otherSection" class="sidebar-link">
        <i class="fas fa-check-circle"></i>
        Other Details
    </a>

</div>

<style>

#promotionSidebar{

    position:sticky;
    top:20px;
    background:#fff;
    border-radius:10px;
    padding:20px;
    box-shadow:0 3px 12px rgba(0,0,0,.08);

}

.sidebar-link{

    display:block;
    padding:12px 15px;
    margin-bottom:8px;
    color:#555;
    text-decoration:none;
    border-radius:8px;
    transition:.3s;

}

.sidebar-link:hover{

    background:#eef5ff;
    color:#0d6efd;

}

.sidebar-link.active{

    background:#0d6efd;
    color:white;

}

.sidebar-link i{

    width:25px;

}

</style>

<script>

$(function(){

    /*
    |--------------------------------------------------------------------------
    | Smooth Scroll
    |--------------------------------------------------------------------------
    */

    $(".sidebar-link").click(function(e){

        e.preventDefault();

        let target=$(this).attr("href");

        if($(target).length){

            $("html,body").animate({

                scrollTop:$(target).offset().top-15

            },500);

        }

    });

    /*
    |--------------------------------------------------------------------------
    | Scroll Spy
    |--------------------------------------------------------------------------
    */

    $(window).on("scroll",function(){

        let scroll=$(window).scrollTop()+180;

        $(".sidebar-link").removeClass("active");

        $("div[id$='Section']").each(function(){

            if(scroll>=$(this).offset().top){

                let id=$(this).attr("id");

                $(".sidebar-link[href='#"+id+"']")
                    .addClass("active");

            }

        });

    });

});

</script>