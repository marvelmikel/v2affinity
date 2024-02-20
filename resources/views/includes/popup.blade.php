<!-- Popup Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div style="text-align: center; position: relative;">
  <span style="color:#D759AC; margin-right:35%; margin-top:5%" class="close" onclick="closeModalOnImage()">&times;</span>
    <img src="{{asset('images/discount.jpg')}}" alt="Popup Image" style="width: 30%; height: 20%; display: inline-block; margin-top:100px">
  </div>
  

</div>

<!-- Inline CSS -->
<style>
.modal {
  display: none;
  position: fixed;
  z-index: 20000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4);
  padding-top: 60px;
 
}

.close {
  color: #aaaaaa;
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover {
  color: #000;
}
</style>

<!-- Inline JavaScript -->
<script>
function closeModal() {
  var modal = document.getElementById("myModal");
  modal.style.display = "none";
}

function closeModalOnImage() {
  closeModal();
}

window.onload = function() {
  var modal = document.getElementById("myModal");

  // Open the modal
  modal.style.display = "block";

  // Close the modal if the user clicks anywhere outside of it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
}
</script>
