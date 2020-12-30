import Tabulator from 'qtype_categorise/tabulator.es2015';
export const init = () => {
//define some sample data
var tabledata = [
    {col0:"",col1:"Col1",col2: "Col2"},
    {col0:"Row1",col1:"El1",col2: "El2"},
    {col0:"Row2",col1:"El3",col2: "El4"}
    ];
//create Tabulator on DOM element with id "example-table"
var table = new Tabulator("#example-table", {
    headerSort:false, //disable header sort for all columns
    headerVisible:false, //hide header
    layout:"fitColumns",
    movableRows: true,
    reactiveData:true, //turn on data reactivity
    height:205, // set height of table (in CSS or here), this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
    data:tabledata, //assign data to table
    layout:"fitColumns", //fit columns to width of table (optional)
    columns:[ //Define Table Columns
        {title:"", field:"col0", editor:"input"},
        {title:"", field:"col1", editor:"input"},
        {title:"", field:"col2", editor:"input"}
    ],
});


//Add row on "Add Row" button click
document.getElementById("add-row").addEventListener("click", function(){
    table.addRow({});
});

//Delete row on "Delete Row" button click
document.getElementById("del-row").addEventListener("click", function(){
    tabledata.pop();
});

//Clear table on "Empty the table" button click
document.getElementById("clear").addEventListener("click", function(){
    table.clearData()
});

//Clear table on "Empty the table" button click
document.getElementById("add-col").addEventListener("click", function(){
    debugger;
    eval(1+1);
    var colcount = table.columnManager.columns.length;
    var newcol = colcount + 1;
    //table.addColumn({title:"",field:newcol, editor:"input"}, false);
    table.addColumn( {title:"", field:"X", editor:"input"}, false);

});


};