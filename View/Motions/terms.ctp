<?php
echo $this->Html->script('d3.layout.cloud', array('inline' => false));

$termsJson = array();
$largest = $terms[key($terms)]['Term']['count'];
end($terms);
$smallest = $terms[key($terms)]['Term']['count'];
$levelStage = ($largest - $smallest) / 20;
foreach ($terms AS $term) {
    $termsJson[] = array(
        'text' => $term['Term']['name'],
        'size' => intval($term['Term']['count'] / $levelStage) * 12,
    );
}
?>
<div class="container">
    <script>
        var fill = d3.scale.category20();
        var terms = <?php echo json_encode($termsJson); ?>;

        d3.layout.cloud().size([900, 900])
                .words(terms)
                .padding(5)
                .rotate(function() {
                    return ~~(Math.random() * 2) * 90;
                })
                .fontSize(function(d) {
                    return d.size;
                })
                .on("end", draw)
                .start();

        function draw(words) {
            d3.select("div.container").append("svg")
                    .attr("width", 900)
                    .attr("height", 900)
                    .append("g")
                    .attr("transform", "translate(450,300)")
                    .selectAll("text")
                    .data(words)
                    .enter().append("text")
                    .style("font-size", function(d) {
                        return d.size + "px";
                    })
                    .style("fill", function(d, i) {
                        return fill(i);
                    })
                    .attr("text-anchor", "middle")
                    .attr("transform", function(d) {
                        return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
                    })
                    .text(function(d) {
                        return d.text;
                    });
        }
    </script>
</div><!--/container-->