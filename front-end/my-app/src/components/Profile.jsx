import { useContext, useEffect } from "react"
import { AuthContext } from "./AuthenticationState"



const Profile=()=>{
    
    return(
        <div className="container">
        <h1 className="title">User Profile</h1>
        <ul className="profile-list">
            <li className="profile-item">
                <span className="field-name">Email:</span>
                <span className="field-value"></span>
                <button className="edit-button">Edit</button>
            </li>
            <li className="profile-item">
                <span className="field-name">Username:</span>
                <span className="field-value"></span>
                <button className="edit-button">Edit</button>
            </li>
            <li className="profile-item">
                <span className="field-name">Phone:</span>
                <span className="field-value">123-456-7890</span>
                <button className="edit-button">Edit</button>
            </li>
        </ul>
        <div className="edit-section">
            <input type="text" className="edit-input" placeholder="Enter new value"/>
            <button className="save-button">Save</button>
            <button className="cancel-button">Cancel</button>
        </div>
    </div>
    )
}
export default Profile;

