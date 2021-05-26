$(document).ready(function(){
	/* declaring variables for circles */
	var sizes = [146, 75]; // first is big array , second for small arrays
	var empty_fill_color = ['#CAD9E6']; // color of the empty arc
	var thicknes = [25, 12.5]; 
	// colors for gradient
	var gradient_colors = [
		"#376aa4", 
		/*"#4076b2", 
		"#4c88c6", 
		"#5899da",*/
		"#5ea2e4"
	];
	// concat to one array of circles
	var circles = Array.prototype.concat(
	                $('.circle-score-big'), 
	                $('.circle-score-small')
	            );
	// concat to one array of scores
	var circles_scores = Array.prototype.concat(
	                       $('.circle-score-big').find('span.total-score') , 
	                       $('.circle-score-small').find('span.total-score')
	                    );
	/* end of declaring variables */

	/* displaying circles */
	for (var i = 0; i < circles.length; i++ ) {
	    for (var j = 0; j < circles[i].length; j++) {
	        $(circles[i][j]).circleProgress({
	            value: $(circles_scores[i][j]).text() / 10,
	            size: sizes[i],
	            thickness: thicknes[i],
	            startAngle: -Math.PI/2,
	            emptyFill: empty_fill_color,
	            fill: {
	              gradient: gradient_colors	
	            }
	        }).on('circle-animation-progress', function(event, progress, value) {
		    	$(this).find('.total-score').text(
		    		(''+(+value * 10 * progress).toFixed(1))
	    		);
			});
	    }
	}
	/* end of logic for dispalying circles */
});