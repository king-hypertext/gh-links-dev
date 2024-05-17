import React, { createContext, useContext, useState } from "react";

const StateContext = createContext({
    user: null,
    token: null,
    setUser: () => { },
    setToken: () => { }
})
export const ContextProvider = ({ children }) => {
    const [user, setUser] = useState({});
    const [token, _setToken] = useState(localStorage.getItem('AUTH_TOKEN'));
    const setToken = (newToken) => {
        _setToken(newToken);
        newToken ? localStorage.setItem('AUTH_TOKEN', newToken) : localStorage.removeItem('AUTH_TOKEN')
    }
    return (
        <StateContext.Provider value={{ user, token, setUser, setToken }}>
            {children}
        </StateContext.Provider>
    )
}
export const useStateContext = () => useContext(StateContext)