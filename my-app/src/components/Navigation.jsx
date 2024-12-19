import React from 'react';

const Navigation=()=>{
    return (
        <header style={styles.header}>
            <h1 style={styles.heading}>Dobrodosli na CHAT APP</h1>
        </header>
    );
};


const styles={
    nav:{
        display: 'flex',
        justifyContent: 'space-between',
        alignItems: 'center',
        backgroundColor: '#333',
        padding: '10px 20px',
        color: 'white',
    },
    heading:{
        color:'red'
    },
}

export default Navigation;