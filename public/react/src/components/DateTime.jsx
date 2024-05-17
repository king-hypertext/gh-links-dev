import moment from 'moment'
import React, { useEffect } from 'react'

function DateTime({ time = false, date = false }) {
    const [staticDtate, setStaticDate] = React.useState(moment())
    useEffect(() => {
        const timer = setInterval(() => {
                setStaticDate(moment())
            }, 1000);
        return () => {
            clearInterval(timer);
        }
    }, []);

    return (
        <>
            {time && date ? staticDtate.format('ddd, MMMM Do YYYY h:mm:ss A') : time ? staticDtate.format('h:mm:ss A') : date && staticDtate.format('ddd, MMMM Do YYYY')}
        </>
    )
}

export default DateTime
