const inputElements = [...document.querySelectorAll('input.input-verify')]

inputElements.forEach((ele,index)=>{
  ele.addEventListener('keydown',(e)=>{
    if(e.keyCode === 8 && e.target.value==='') inputElements[Math.max(0,index-1)].focus()
  })
  ele.addEventListener('input',(e)=>{
    const [first,...rest] = e.target.value
    e.target.value = first ?? ''
    if(index!==inputElements.length-1 && first!==undefined) {
      inputElements[index+1].focus()
      inputElements[index+1].value = rest.join('')
      inputElements[index+1].dispatchEvent(new Event('input'))
    }
  })
})


function onSubmit(e){
  e.preventDefault()
  const code = [...document.getElementsByTagName('input')]
    .filter(({name})=>name)
    .map(({value})=>value)
    .join('')
  console.log(code)
}