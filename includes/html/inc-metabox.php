<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
    <style>
    div#movie {
/*     background-color: #032541;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    width: 68%;
    cursor: pointer; */
}
input#moviein {
    width: 100%;
}
    </style>   
    <input type='text' id='moviein' name='moviein'><br><br>
    <div id='movie' class="button">GET INFo</div>
<div id="akefi_Container" style="display:none;">
	<input id="akefi_url" type="url" name="akefi_url" placeholder="URL" style="visibility: hidden;" />
	<a id="akefi_preview" class="button" style="text-align:center;width:46%;display:inline-block;"><?php _e('Preview', ak_EUFI_DOMAIN) ?></a>
	<input id="akefi_alt" type="text" name="akefi_alt" placeholder="Alt text" style="width:100%">
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        if (typeof $ == 'undefined') {
           var $ = jQuery;
        }
         
        movieid = document.getElementById("movie");
        movieidgt = document.getElementById("moviein");
        keyar = [];
        casts= [];
        videos= [];
        movieid.addEventListener("click", function() {
        movid = movieidgt.value;
        url = "//api.themoviedb.org/3/";
        mode = "movie/";
         key = "?api_key=<?php echo esc_attr(get_option('ak_plugin_options')[api_key]);?>";
        Promise.all([
            fetch(url + mode + movid + key ),
            fetch(url + mode  + movid + "/keywords"+ key),
            fetch(url + mode  + movid + "/alternative_titles"+ key),
            fetch(url + mode  + movid + "/credits"+ key),
            fetch(url + mode  + movid + "/videos"+ key)
            
        ]).then(async([aa, bb,cc,dd,ee]) => {
            const a = await aa.json();
            const b = await bb.json();
            const c = await cc.json();
            const d = await dd.json();
            const e = await ee.json();
            return [a, b, c,d,e]
        })
        .then((responseText) => {
            movd= responseText[0];
            movgenres = responseText[0].genres;
            movkeywords = responseText[1].keywords;
            movtitle = responseText[2].titles;
            movcast= responseText[3].cast;
            movvideo= responseText[4].results;
            // genres
            movgenres.forEach(genre => {
                genre = genre.name;
                keyar.push(genre);
            });
            // keywords
            movkeywords.forEach(keyword => {
                key = keyword.name;
                keyar.push(key);
            });
            // all title
            movtitle.forEach(title => {
                ti = title.title;
                keyar.push(ti);
            });
            // all cast
            movcast.forEach(cast => {
                cast = cast.name;
                casts.push(cast);
            });
            
            // all video
             movvideo.forEach(video => {
                video = video.key;
                videos.push(video);
            });


            title = movd.title;
            discr = movd.overview;
            img = "https://www.themoviedb.org/t/p/w300_and_h450_bestv2" + movd.poster_path;
            imdb = movd.vote_average;
            year = movd.release_date;
            year1 = new Date(year);
            keywo = keyar.join();
            mocast = casts.join();
             

             
         
            iframe = document.getElementById("content_ifr");
            elmnt = iframe.contentWindow.document.getElementById("tinymce")[0];
			document.getElementById( "akefi_url" ).value = img;
           document.getElementById( "akefi_alt" ).value = title;
       
            $( "#title" ).val(title) ;
             $( "#focus-keyword-input-metabox" ).val(title) ;
             
                
			
                var bodydiv = document.createElement("div");
                bodydiv.className = "aClassName";
                bodydiv.style.cssText = 'text-align: center;';
			
				
 				var addbr = document.createElement("br");
			
				function myh3tp1(p1) {
					var h3div = document.createElement("h2");
					 h3tp1 = document.createTextNode(p1); 
				  return h3tp1;   
				}
			
                var hp3 = document.createElement("p");
                var tp3 = document.createTextNode("year"+' :- '+year1.getFullYear()); 
                hp3.appendChild(tp3); 
                bodydiv.appendChild(hp3);
				bodydiv.appendChild(addbr);
			
                var hp4 = document.createElement("p");
                var tp4 = document.createTextNode('imdb'+' :- '+imdb); 
                hp4.appendChild(tp4); 
                bodydiv.appendChild(hp4);
                bodydiv.appendChild(addbr);
                
                var hp = document.createElement("p");
                var tp = document.createTextNode(discr); 
                hp.appendChild(tp); 
                bodydiv.appendChild(hp);
                bodydiv.appendChild(addbr);
                 
				addvido =  myh3tp1('video');
				bodydiv.appendChild(addbr);
				bodydiv.appendChild(addvido);
                var hpvideos = document.createElement("iframe");
                hpvideos.src= "//www.youtube.com/embed/"+videos[0];
                hpvideos.style.width = "640px";
                hpvideos.style.height = "480px";
                bodydiv.appendChild(hpvideos);
                bodydiv.appendChild(addbr);
               
                
                var hp1 = document.createElement("p");
                var tp1 = document.createTextNode(mocast); 
                hp1.appendChild(tp1); 
                bodydiv.appendChild(hp1);
                bodydiv.appendChild(addbr);
			
                var hp2 = document.createElement("p");
                var tp2 = document.createTextNode(keywo); 
                hp2.appendChild(tp2); 
                bodydiv.appendChild(hp2);
 				bodydiv.appendChild(addbr);
			
            iframe.contentWindow.document.getElementsByTagName("p")[0].remove();
            iframe.contentWindow.document.body.append(bodydiv);

             $( ".field.field-name_post input" ).val(title) ;
             $( ".field.field-name_post input" ).click();
             $( ".field.field-story .cfs_textarea .textarea" ).val(discr) ;
             $( "#new-tag-post_tag" ).val(keywo) ;
             $( ".field.field-keywor input" ).val(keywo) ;
             $( ".button.tagadd" ).click();
             $( ".field.field-years input" ).val(year1.getFullYear()) ;
             $( ".field.field-nameact input" ).val(mocast) ;
             $( ".field.field-nimdb input" ).val(imdb) ;
           	document.getElementById( "publish" ).click();
			//-----------
        }).catch((err) => {
            console.log(err);
        });


}, false);
  });

	


</script>
