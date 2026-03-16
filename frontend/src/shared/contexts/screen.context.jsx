import React, { createContext, useContext } from 'react'

const ScreenContext = createContext();

function ScreenProvider({ children }) {
    const [screen, setScreen] = React.useState({
        title: 'Home',
        showTitle: false,
        titleAction: null,
    });

    const setTitle = (title) => {
        setScreen((prev) => ({ ...prev, title }));
    };

    const setShowTitle = (showTitle) => {
        setScreen((prev) => ({ ...prev, showTitle }));
    };

    const setTitleAction = (titleAction) => {
        setScreen((prev) => ({ ...prev, titleAction }));
    };

    return (
        <ScreenContext.Provider value={{ screen, setTitle, setShowTitle, setTitleAction }}>
            {children}
        </ScreenContext.Provider>
    )
}

export { ScreenProvider };
export default () => useContext(ScreenContext);