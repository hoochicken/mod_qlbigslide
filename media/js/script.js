if (!window.Joomla) {
  throw new Error('Joomla API was not properly initialised');
}

alert('asdasd')

const arr = Joomla.getOptions('mod_qlbigslide.vars');
console.log(arr);   // outputs Object { suffix: "!" }
alert(arr);   // outputs Object { suffix: "!" }

const { suffix } = Joomla.getOptions('mod_hello.vars');
document.querySelectorAll('.mod_hello').forEach(element => {
  element.innerText += suffix;
});