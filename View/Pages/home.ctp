<div class="container">
    <div>#註：
        <font color="0033FF">中國國民黨</font>&nbsp;-&nbsp;<font color="009900">民主進步黨</font>&nbsp;-&nbsp;
        <font color="orange">親民黨</font>&nbsp;-&nbsp;<font color="brown">台灣團結聯盟</font>&nbsp;-&nbsp;
        <font color="FF00FF">無黨團結聯盟</font>&nbsp;-&nbsp;<font color="777777">無黨籍</font>
        /
        <div class="btn-group">
            <a href="#" class="btn btn-default btn-draw-type" data-draw-type="all">依據提案+連署數</a>
            <a href="#" class="btn btn-default btn-draw-type" data-draw-type="requester">依據提案數</a>
            <a href="#" class="btn btn-default btn-draw-type" data-draw-type="petition">依據連署數</a>
        </div>
    </div>
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

    var d3JsonData = {};

    $.getJSON("<?php echo $this->Html->url('/parliamentarians/stat'); ?>?>", function(r) {
        d3JsonData = r;
        parliamentariansDraw(d3JsonData);
    });

    $('a.btn-draw-type').click(function() {
        var selectedDrawType = $(this).attr('data-draw-type');
        parliamentariansDraw(d3JsonData, selectedDrawType);
        return false;
    });

    var parliamentariansDraw = function(root, drawBaseType) {
        $("#pageHomeBubble svg").html('');
        switch (drawBaseType) {
            case 'requester':
                for (k in root.children) {
                    root.children[k].value = root.children[k].count_submits;
                }
                break;
            case 'petition':
                for (k in root.children) {
                    root.children[k].value = root.children[k].count_petitions;
                }
                break;
            default:
                for (k in root.children) {
                    root.children[k].value = parseInt(root.children[k].count_submits) + parseInt(root.children[k].count_petitions);
                }
        }
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
        d3.select(self.frameElement).style("height", diameter + "px");
    };

</script>