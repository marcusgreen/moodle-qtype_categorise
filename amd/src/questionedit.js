import Templates from 'core/templates';
export const init = () => {
   var lastname= 'marcus';

   var mynode=document.getElementById('mynode');

   document.getElementById("addcategory").addEventListener("click", function(){
            addCriteria(mynode);
    }, false);

   function addCriteria(mynode) {
    debugger;
    var category=document.getElementById('category');
    var cloned=category.cloneNode(true);
    mynode.appendChild(cloned);
  }
};