import "./Products.css";

const Modal=({isOpen,onAction})=>{
    if(!isOpen) return null;

    // const handleButtonClick=(action)=>{
    //     confirmOrDelete(action);
    // }

    return(
        
        <div
        className="modal_custom"
        >
            <div
                className="bg-white p-6 rounded shadow-lg"
                 // Prevent closing when clicking inside the modal
            >
                <div className="modal-content">
                    This is modal content
                </div>
                <button className="absolute top-2 right-2" onClick={()=>onAction('Confirm')}>
                Confirm delete
                </button>
                <button className="absolute top-2 right-2" onClick={()=>onAction('Cancel')}>
                Cancel delete
                </button>
            </div>
        </div>
    )
}

export default Modal;