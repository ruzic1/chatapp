// import React, { useContext } from "react";
// import { AuthContext,useAuth } from "./AuthenticationState";
// import { Navigate } from "react-router-dom";

// const ProtectedRoute=({children,redirectTo})=>{
//     const {user} =useAuth();
//     const parsed=JSON.parse(JSON.stringify(user));
//     console.log(parsed);
//     return parsed?children:<Navigate to={redirectTo}/>
// }
// export default ProtectedRoute;