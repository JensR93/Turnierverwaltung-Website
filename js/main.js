$(document).ready(function(){
    //Highlight a team when hovered
    $(".m_segment").on("mouseover mouseout",function () {
            var $this = $(this);
            var winnderId = $this.attr("data-team-KompletterName");
            var $teams = $("[data-team-KompletterName="+winnderId+"]");
            $teams.toggleClass('highlight').parent().toggleClass('highlight');
    });
    // highlight each round with its similar reversed round
    function highlightRounds(roundClass){
        roundClass.on('mouseover mouseout',function(){
            roundClass.toggleClass('focus')
        })
    }
    highlightRounds($('.r_16'));
    highlightRounds($('.r_8'));
    highlightRounds($('.r_4'));
    highlightRounds($('.r_2'));

});
