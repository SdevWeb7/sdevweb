export function DragInit (drake) {
   drake.on('drag', (el) => {
      document.querySelectorAll('.todo').forEach(todo => {
         if (todo !== el) {
            todo.classList.add('dragging')
         }
      })
   });
   drake.on('dragend', (el) => {
      document.querySelectorAll('.todo').forEach(todo => {
         if (todo !== el) {
            todo.classList.remove('dragging')
         }
      })
   });
}