/**
 * Created by dengyonghui on 15/6/11.
 */


renderCreditData();

function renderCreditData()
{
    // render the credit form
    renderCreditForm();

    // render the credit progress
    renderCreditProgress();

    // render the Spherical figure of credit
    renderCreditCircle();
}

// render the credit form
function renderCreditForm()
{
    var tableBody = $("#credit_content").find("tbody");
    tableBody.empty();

    // render pagination
    renderCreditFormPagination();

    for(var i = 0; i < 4; i++)
    {
        var index = i + showPage * CREDIT_NUM_PAGE;
        var credit = creditList[index];

        var tableRow = $("<tr>");

        if(typeof(credit)!="undefined")
        {
            tableRow.append($("<td>", {"text":index + 1}));
            tableRow.append($("<td>", {"text":credit.name}));
            tableRow.append($("<td>", {"text":credit.actualCredits}));
            tableRow.append($("<td>", {"text":credit.standard}));
        }
        else
        {
            tableRow.append($("<td>",{"text":"-"})).append($("<td>")).append($("<td>")).append($("<td>"));
        }

        tableBody.append(tableRow);
    }

}

//render the Pagination of the credit form
function renderCreditFormPagination()
{
    var pagination = $("#credit_content").find(".pagination").find("ul");
    pagination.empty();

    var beginPage = showPage;
    if(showPage >= totalPage - 5)
        beginPage = totalPage - 5;
    if(totalPage < 5)
        beginPage = 0;
    var showPagewNum = totalPage <= 5 ? totalPage : 5;
    for(var i = 0; i < showPagewNum + 2; i++)
    {
        var text = i == 0 ? "Prev" : i == showPagewNum+1 ? "Next" :  i == showPagewNum ? totalPage : i + beginPage;
        if(beginPage != totalPage - 5 && i == showPagewNum - 1 &&  totalPage > 5)
            text = "...";

        var type = (text == showPage+1) ? "btn btn-primary" : "btn btn-default";
        var paginationBtn = $("<li>").append($("<a>",
            {
                "class"     :   type,
                "href"      :   "javascript:void(0)",
                "onclick"   :   "clickPagination(\"" + text + "\")",
                "text"      :    text
            }));
        pagination.append(paginationBtn);
    }
}

// to do 这个总进度条要改，现在随便试试的
// render the credit progress
function renderCreditProgress()
{
    if(creditList.length == 0) return;

    var progressList = $("#credit_content").find(".credit-progress-list");
    progressList.empty();

    var progressTotal = $("#credit_content").find(".credit-progress-total");

    // total,to do
    var totalNum = 0;
    for(i = 0; i < creditList.length;i++)
    {
        credit = creditList[i];
        totalNum += credit.standard;
    }

    for(i = 0; i < creditList.length;i++)
    {
        var credit = creditList[i];

        var scale = Math.floor(credit.actualCredits / totalNum * 100); // for example 50
        scale = scale > 100 ? 100 : scale < 0 ? 0 : scale;
        var scaleText = scale + "%"; // for example 50%

        // 随便定的颜色，to change
        var classList = ["progress-bar progress-bar-success","progress-bar progress-bar-info","progress-bar progress-bar-warning"
            ,"progress-bar progress-bar-danger"];
        var progressClass = classList[i%4];

        var progressDiv =  $("<div>", {
            "class" : progressClass,
            "role"  : "progressbar",
            "aria-valuenow" : "60",
            "aria-valuemin" : "0",
            "aria-valuemax" : "100",
            "onmouseover"   : "toolTipMouseOver(0,"+i+")",
            "onmousemove"   : "toolTipMouseMove(0,0)",
            "onmouseout"   : "toolTipMouseOut(0,0)",
            "style" : "width: " + scaleText + ";"
        }).append($("<span>",
            {
                "text" : scale > 2 ? scaleText : ""
            }));

        progressTotal.append(progressDiv);

        credit = creditList[i];
        progressDiv =  $("<div>", {
            "text" : credit.name
        });


        // every credit
        scale = Math.floor(credit.actualCredits / credit.standard * 100); // for example 50
        scale = scale > 100 ? 100 : scale < 0 ? 0 : scale;
        scaleText = scale + "%"; // for example 50%

        progressClass = scale > 75 ? "progress-bar progress-bar-success" :
            scale > 40 ? "progress-bar progress-bar-info":
                scale > 20 ? "progress-bar progress-bar-warning":
                    "progress-bar progress-bar-danger";


        progressDiv.append($("<div>", {
            "class" : "progress progress-striped active"
        }).append($("<div>", {
            "class" : progressClass,
            "role"  : "progressbar",
            "aria-valuenow" : "60",
            "aria-valuemin" : "0",
            "aria-valuemax" : "100",
            "onmouseover"   : "toolTipMouseOver(0,"+i+")",
            "onmousemove"   : "toolTipMouseMove(0,0)",
            "onmouseout"   : "toolTipMouseOut(0,0)",
            "style" : "width: " + scaleText + ";"
        }).append($("<span>",
            {
                "text" : scale > 5 ? scaleText : ""
            }))));
        progressList.append(progressDiv);
    }
}

//click pagination
function clickPagination(text)
{
    switch (text)
    {
        case "Prev":
            if(showPage == 0) return;
            showPage--;
            break;
        case "Next":
            if(showPage == totalPage - 1) return;
            showPage++;
            break;
        case "...":
            return;
        default :
            showPage = parseInt(text) - 1;
    }

    renderCreditForm();
}

// render the Spherical figure of credit
function renderCreditCircle()
{
    var width = 350;
    var height = 350;

    $("#credit-graph").empty();

    var svg = d3.select("#credit-graph").append("svg")
        .attr("width", width)
        .attr("height", height)
        .attr("margin", "0 auto");

    var pie = d3.layout.pie();

    var outerRadius = width / 2;
    var arc = d3.svg.arc()
        .innerRadius(0)
        .outerRadius(outerRadius);

    var sum = 0;
    var dataset = [];
    var maxdate = 0;
    var rate = [];
    for (var i = 0; i < creditList.length; i++) {
        dataset[i] = creditList[i].actualCredits;
        sum += dataset[i];

        if(dataset[i] > maxdate)
          maxdate = dataset[i];
    }

    var color = ["#1A4f65","#2A5f75", "#3A6f85", "#4A7f95", "#5A8fa5", "#6A9fb5", "#7Aafc5", "#8Abfd6", "#9Acfe6", "#9Acfe6","#aAdff5"];

    var arcs = svg.selectAll("g")
        .data(pie(dataset))
        .enter()
        .append("g")
        .attr("transform", "translate(" + outerRadius + "," + outerRadius + ")")
        .on("mouseover", toolTipMouseOver)
        .on("mousemove", toolTipMouseMove)
        .on("mouseout", toolTipMouseOut);

    arcs.append("path")
        .attr("fill", function (d, i) {
            var num = Math.floor((d.value /(maxdate + 1)) * color.length);

            return color[num];
        })
        .attr("d", function (d) {
            return arc(d);
        });

    arcs.append("text")
        .attr("transform", function (d, i) {
            return "translate(" + arc.centroid(d) + ")";
        })
        .attr("text-anchor", "middle")
        .text(function (d) {
            var rate = parseInt(toDecimal(d.value / 1.0 / sum)　*　100
            );

            return 　rate >= 7 ? rate+"%" : "";
        })
        .attr("fill", "white");
}

function toolTipMouseOver(d, i)
{
    tooltip.style("visibility", "visible");
    tooltip.style("top",
        event.pageY - 40+"px").style("left", event.pageX - 220 + "px");
        //(d3.event.pageY - 10) + "px").style("left", (d3.event.pageX + 10) + "px");
    tooltip.html(function () {
        return "<span style='font-size:15px;text-align:center'>" + creditList[i].name + "</span><br><br>"
            + "<strong>已修学分:</strong> <span style='color:red'>" + creditList[i].actualCredits + "</span><br>"
        + "<strong>需修学分:</strong> <span style='color:red'>" + creditList[i].standard + "</span><br>";
    });
}

function toolTipMouseMove(d, i)
{
    tooltip.style("top",
        event.pageY - 40 +"px").style("left", event.pageX - 220 + "px");
    //(d3.event.pageY - 10) + "px").style("left", (d3.event.pageX + 10) + "px");
}

function toolTipMouseOut(d, i)
{
    tooltip.style("visibility", "hidden");
}

var tooltip = d3.select("#credit_content")
    .append("div")
    .attr('class', 'd3-tip')
    .style("position", "absolute")
    .style("z-index", "10")
    .style("visibility", "hidden");

function toDecimal(x) {
    var f = parseFloat(x);
    if (isNaN(f)) {
        return;
    }
    f = Math.round(x * 100) / 100;
    return f;
}