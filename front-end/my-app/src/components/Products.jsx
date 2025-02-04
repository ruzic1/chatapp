import React,{useState,useEffect, useContext,useRef} from 'react';
import './Products.css';
import './Profile.css';
import { AuthContext } from './AuthenticationState';
import { useAuth } from './AuthenticationState';
// import {v4 as uuidv4}
import {v4 as uuidv4} from 'uuid';
import {CSSTransition} from 'react-transition-group';
import Modal from './Modal';

const Products=()=>{
    const[chats,setChats]=useState([]);
    const [chatsForUser,setChatsForUser]=useState([]);
    const [message,setMessage]=useState();
    const [socket,setSocket]=useState();
    const [recipientUser,setRecipientUser]=useState();
    const [extendedWidth, setExtendedWidth] = useState("auto");
    const [isHovered,setIsHovered]=useState(false);
    const [isModalClicked,setIsModalClicked]=useState(false);
    const [modalResponse,setModalResponse]=useState(null);
    const [usernameOfAddedContact,setUsernameOfAddedContact]=useState("");
    const [isContactFormVisible,setIsContactFormVisible]=useState(false);
    const [isContactSuccessful,setIsContactSuccessful]=useState({success:null,message:null});
    const nodeRef=useRef(null);

    useEffect(()=>{

        const returnUserChats=async()=>{
            const call1=await fetch('/contacts');
            if(call1){
                const data=await call1.json();
                console.log(data)
                setChats(data);

                // setChats(JSON.parse(call1));
                // console.log('OVO SE SETOVALO')
                // console.log(chats);
                // console.log(typeof chats);
            }
            // console.log(chats);
            // console.log(call1);

            const response=await fetch('/user-connections');
            console.log(response);
        }
        returnUserChats();
        // console.log(chats)
        // console.log
        // console.log(Object.entries(JSON.parse))
        
    },[])

    useEffect(()=>{
        const ws=new WebSocket(`ws://127.0.0.1:8080`);
        const username=sessionStorage.getItem('user');
        setSocket(ws);


        ws.onopen=()=>{
            console.log('Websocket connection established');
            ws.send(JSON.stringify({username:JSON.parse(sessionStorage.getItem('user')).username}));
        }
        ws.onmessage=(event)=>{
            // console.log(sessionStorage.getItem('user')['username']);
            // const username=sessionStorage.getItem('user')['username'];
            // const messageData={
            //     type:'send_message',
            //     sender:sessionStorage.getItem('user'),
            //     recipient:recipientUser,


            // }
            // socket.send(JSON.stringify())
            const newMessage=JSON.parse(event.data);
            console.log(newMessage);
            setChatsForUser((prevChats)=>[
                ...prevChats,
                {
                    from:newMessage.from,
                    message:newMessage.message
                }
            ]);
            const formattedToArray=[
                
            ]
            // setChatsForUser((prevChats)=>[...prevChats,newMessage]);
            // console.log('Poruke nakon slanja i apdejta:'+chatsForUser);
            // setChatsForUser((prevMessages)=>[...prevMessages,newMessage]);
            // console.log(chatsForUser);
            // console.log('Meessage recieved:'+event.data);
        }
        // ws.onclose
    },[])

    let chatsWithIds;
    const returnClickedChat=async(username)=>{

        const value=username;

        const response=await fetch('/message-retrieval',{
            method:'POST',
            headers:{
                'Content-Type':'application/json'
            },
            body:JSON.stringify(value)

        });
        const data=await response.json();
        if(data){
            console.log(data);
            setChatsForUser(data);
            // setChatsForUser(() =>
            //     Object.entries(data).map(([key, value]) => ({
            //       id: uuidv4(),
            //       key,
            //       value,
            //     }))
            //   );
            console.log('Poruke na pocettku'+chatsForUser);
            setRecipientUser(value);
            // chatsWithIds=Object.entries(data).map(([key,value])=>({
            //     id:uuidv4(),
            //     key,
            //     value
            // }));
        }else{
            setChatsForUser(false);
            // console.log("There are no messages with this particular user");
        }

        // console.log(chatsForUser);
        // console.log(chatsWithIds);
        // setChatsForUser(()=>{

        // }data);
        
        console.log('Usao je u funkciju i ovo je korisnicko ime:'+value);
    
    }

    const sendingMessage=(msg,recipient_user)=>{
        console.log('Ulazi u funkciju za slanje poruka:'+msg);
        // console.log('Salje se korisniku:'+username);
        console.log(JSON.parse(sessionStorage.getItem('user')).username);
        const sender_user=JSON.parse(sessionStorage.getItem('user')).username;
        console.log(socket);
        if(socket&&socket.readyState==WebSocket.OPEN){
            const message={

                sender_username:sender_user,
                recipient_username:recipient_user,
                message:msg
            }
            console.log(message);
            socket.send(JSON.stringify(message));

            setChatsForUser((prevChats)=>[
                ...prevChats,
                {
                    sender_user:sender_user,
                    recipient_user,
                    message:msg
                    // from:newMessage.from,
                    // message:newMessage.message
                }
            ]);

        }else{
            console.error('Websocket is not established yet');
        }


    }

    const handleMouseEnter=(e,id)=>{
        setIsHovered(id);
        // setExtendedWidth(`${e.target.offsetWidth+200}px`);
        
    }
    const handleMouseLeave=()=>setIsHovered(false);
    
    const handleModalAction=(action)=>{
        setModalResponse(action);
        console.log(modalResponse);
    }
    //Message deleting
    const handleMessageDeleting=async(msgId)=>{
        // setIsModalClicked(true);
        setIsModalClicked(true);
        // console.log(whatIsClicked);
        // const response=await fetch('/message-deleting',{
        //     method:'POST',
        //     headers:{
        //         'Content-Type':'application/json'
        //     },
        //     body:JSON.stringify(msgId)
        // });

        // const data=await response.json();
        // if(data){
            
        //     setChatsForUser((prevChats)=> prevChats.filter(msg => msg.id !== msgId))
        // }
       
    }

    const handleInputChange=(event)=>{
        setUsernameOfAddedContact(event.target.value);
    }

    const handleAddingContact=async(e)=>{
        e.preventDefault();
        // console.log(e.target.value);


        // console.log(chats);
        // console.log(JSON.parse(sessionStorage.getItem('user')).username);
        console.log(JSON.parse(sessionStorage.getItem('user')).username)
        const contactExists= Object.values(chats).some(chat=>(chat.username==usernameOfAddedContact||usernameOfAddedContact==JSON.parse(sessionStorage.getItem('user')).username));
        if(!contactExists){
            // console.log('Korisnik ne postoji');
            setIsContactSuccessful(prev=>({...prev,success:false}));
            const response=await fetch('/add-contact',{
                method:'POST',
                headers:{
                    'Content-Type':'application/json',
                },
                body:JSON.stringify({
                    usernameOfAddedContact: usernameOfAddedContact,
                    loggedUsername:JSON.parse(sessionStorage.getItem('user')).username
                })
            });
            const data=await response.json();
            console.log(data);
            setIsContactSuccessful({success:data.success,message:data.message});

            const response2=await fetch('/contacts');
            if(response2){
                const data2=await response2.json();
                setChats(prev=>({...prev,data2})); 
            }

            // console(isContactAlreadyAdded)
            
        }else{
            // console.log('Korisnik postoji');
            setIsContactSuccessful({success:false,message:"User contact is yours, or already added in contact list"});
        }
        // console.log(hasValue);
        
        // if(Object.values(chats).includes("michael123")){
        //     console.log('Kontakt vec postoji');
        // }else console.log('Ne postoji kontakt');
        // if(chats.includes())


        // const response=await fetch('/add-contact');
    }

    const handleNewContact=()=>{
        if(!isContactFormVisible){
            {
                setIsContactFormVisible(true);
                console.log(isContactFormVisible);
                return true;
            }
        }else{
            setIsContactFormVisible(false);
            
            console.log(isContactFormVisible);
            return false;
        }
    }
    return (
        <div className='containerA'>
            {
                
            }
            
            <div className="contacts">
                    {
                        chats ?(
                        <>
                            {chats.map((chat, index) => (
                                <div className="contact" key={index} onClick={()=>returnClickedChat(chat.username)}>
                                    <p>{chat.username}</p>
                                    <img src="user.jpg" alt="User" class="avatar" onerror="this.src='placeholder.png'"/>
                                    
                                    
                                    
                                </div>
                                
                                
                            ))}
                            
                                <button className="add-contact" onClick={()=>handleNewContact()}>Add contact</button>
                                <form 
                                style={{display:isContactFormVisible?"block":"none"}}
                                >
                                    <input type="text" placeholder="Enter contact name" class='w-75' onChange={(e)=>handleInputChange(e)}/>
                                    <button type="submit" class='w-25' onClick={(e)=>handleAddingContact(e)}>Add</button>
                                </form>


                        </>
                        ) : (
                            <p>No chats available.</p>
                        )
                        
                        
                    }
                
            </div>

            <div className="chat">
                <div className="messages">
                {chatsForUser
                ?(
                    <>
                    <p>Ima vrednosti u objektu</p>
                        {chatsForUser.map((chat)=>(
                            
                            <div 
                            key={chat.id} 
                            className={`message`}
                            
                            onMouseEnter={(e)=>handleMouseEnter(e,chat.id)} 
                            onMouseLeave={() => handleMouseLeave()}
                            style={isHovered==chat.id? { width: extendedWidth,transition:"width 0.5s ease-in-out"} : {}}
                            ><div className='chat-space'>{chat.message}</div>
                                {
                                isHovered===chat.id
                                ?
                                (<div className="buttons">
                                    <button
                                        className="edit"
                                        
                                    >
                                        Edit
                                    </button>
                                    <button
                                        className="delete"
                                        onClick={()=>handleMessageDeleting(chat.id)}
                                    >
                                        Delete
                                    </button>
                                </div>)
                                :(
                                    <></>
                                )
                                }
                            </div>
                        ))}
                    </>
                )
                :chatsForUser==false?(
                    <p>Say 'hello'!</p>
                )
                :(<></>)
                }
                </div>
                <div className="input-area">
                    <div className="abcTest">

                    </div>
                    <input type="text" placeholder="Type a message..." id='textMessage' value={message} onChange={(e)=>setMessage(e.target.value)}/>
                    <button onClick={()=>sendingMessage(message,recipientUser)}>Send</button>
                </div>
            </div>
            {
                isContactSuccessful.success==false?(
                    <div style={styles.errorContainer}>
                        <p>{isContactSuccessful.message}</p>
                    <button style={styles.closeButton} onClick={()=>setIsContactSuccessful(prev=>({...prev,success:false}))}>X</button>
                    </div>
                ):isContactSuccessful.success==true?(
                    <div style={styles.successContainer}>
                        <p>{isContactSuccessful.message}</p>
                    <button style={styles.closeButton} onClick={()=>setIsContactSuccessful(prev=>({...prev,success:false}))}>X</button>
                    </div>
                ):(
                    <></>
                )
            }    
            <Modal isOpen={isModalClicked} onAction={handleModalAction}>
                <h2>AOWIWJDOWA</h2>
                <p>This will be the message inside modal</p>
            </Modal>
            
        </div>
    )
}

const styles = {
    errorContainer: {
        position: "fixed",
        bottom: "20px",
        left: "50%",
        transform: "translateX(-50%)",
        backgroundColor: "red",
        color: "white",
        padding: "10px 20px",
        borderRadius: "5px",
        display: "flex",
        alignItems: "center",
        justifyContent: "space-between",
        gap: "10px",
        boxShadow: "0px 4px 6px rgba(0, 0, 0, 0.1)"
    },
    successContainer: {
        position: "fixed",
        bottom: "20px",
        left: "50%",
        transform: "translateX(-50%)",
        backgroundColor: "green",
        color: "white",
        padding: "10px 20px",
        borderRadius: "5px",
        display: "flex",
        alignItems: "center",
        justifyContent: "space-between",
        gap: "10px",
        boxShadow: "0px 4px 6px rgba(0, 0, 0, 0.1)"
    },
    closeButton: {
        backgroundColor: "transparent",
        border: "none",
        color: "white",
        fontSize: "16px",
        cursor: "pointer"
    }
};
export default Products;