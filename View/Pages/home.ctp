<div class="container">
    <div id="pageHomeBubble"></div>
</div>

<script>

    var diameter = 800;

    var bubble = d3.layout.pack()
            .sort(null)
            .size([diameter, diameter])
            .padding(1.5);

    var svg = d3.select("#pageHomeBubble").append("svg")
            .attr("width", diameter)
            .attr("height", diameter)
            .attr("class", "bubble");

    d3.json("<?php echo $this->Html->url('/parliamentarians/stat'); ?>?>", function(error, root) {
        var node = svg.selectAll(".node")
                .data(bubble.nodes(root)
                        .filter(function(d) {
                            return !d.children;
                        }))
                .enter().append("g")
                .attr("class", "node")
                .attr("transform", function(d) {
                    return "translate(" + d.x + "," + d.y + ")";
                });

        node.append("title")
                .text(function(d) {
                    return d.className + ":\n" + d.linkTitle;
                });

        node.append("a")
                .attr("xlink:href", function(d) {
                    return "<?php echo $this->Html->url('/parliamentarians/view/'); ?>" + d.id
                })
                .append("circle")
                .attr("r", function(d) {
                    return d.r;
                })
                .style("fill", function(d) {
                    return d.color;
                });
        node.append("a")
                .attr("xlink:href", function(d) {
                    return "<?php echo $this->Html->url('/parliamentarians/view/'); ?>" + d.id
                })
                .append("text")
                .attr("dy", ".3em")
                .style("text-anchor", "middle")
                .text(function(d) {
                    return d.className;
                });
    });

    d3.select(self.frameElement).style("height", diameter + "px");

</script>