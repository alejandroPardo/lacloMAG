<html>
<head>
	<?php
		echo $this->Html->css('app');
		echo $this->Html->css('redactor');

		echo $this->Html->script('library');

		echo $this->Html->script('redactor');		
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<?php echo $cover;?>
	<?php $index=0;
		foreach ($papers as $paper) {

			echo '<div class="title" style="margin-top:20px; margin-bottom:20px;"><h2>'.$magazinePapers[$index]["Paper"]["name"].'</h2></div>';
			echo '<div class="redactor_box redactor_editor" style="margin: 10px 10px 10px 10px;">'./*substr($paper, 0, 2800)*/$paper.'</div>';
			$index++;
		}
		//echo $footer;
	?>

</body>
<script type="text/javascript">
    function arrangePaper() {


        var cover = document.getElementsByClassName("cover");
        cover[0].style["height"] = "1284px";
    	
    	var newPage = document.createElement("div");
    	//newPage.style.height = "1284px";
    	newPage.className = "newPage";

    	var content = document.getElementById("content");
    	var newContent = document.getElementById("newContent");

    	var childObjects = content.children;
    	var elementHeight;

    	var accumulatedHeight = 0;
    	var newElement;
    	var counter = 1;

    	for(var i = 0; i < childObjects.length; i++) {
    		//console.log(childObjects[i]);

    		if (childObjects[i].className.indexOf("title") > -1) {
    			newElement = childObjects[i].cloneNode(true);
    			newPage.appendChild(newElement);
    		}

    		if (childObjects[i].className.indexOf("redactor") > -1) {
    			newElement = childObjects[i].cloneNode(true);
    			newPage.appendChild(newElement);
    			
    		}

    		if(counter % 2 == 0) {
    			newContent.appendChild(newPage);
    			newPage = document.createElement("div");
				//newPage.style.height = "1284px";
				newPage.className = "newPage";
				newContent.appendChild(newPage);
				newPage = document.createElement("div");
				//newPage.style.height = "1284px";
				newPage.className = "newPage";
    		}

            

    		
    		

			counter++;
    	}
        var contentHeight = newContent.clientHeight;
        console.log(contentHeight);
        var numberPages = Math.round(contentHeight / 1284);

        var span;
        span = document.createElement("span");
        span.textContent = numberPages;
        span.className = "totalPages";
        newContent.appendChild(span);

        for(var i=1; i <= numberPages; i++) {
            span = document.createElement("span");
            span.style.position = "absolute";
            acumulatedPage = 1284 + (1284 * i);
            span.style.top = acumulatedPage + "px";
            span.style.right = "100px";
            span.textContent = i;
            span.className = "pageNumber";
            newContent.appendChild(span);

        }

		while (content.firstChild) {
		  content.removeChild(content.firstChild);
		}
    	
    }
    //arrangePaper();
</script>
</html>