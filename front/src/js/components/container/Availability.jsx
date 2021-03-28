import React from 'react'

const Availability = ({availability}) => {
    return (
        <div>
            <h3>Shops: </h3>
            {Object.keys(availability).map((i) => {
                return (<div>
                        <h5>{availability[i].shop}</h5>
                        <p>{availability[i].address}</p>
                        <p>{availability[i].available}</p>
                    </div>
                )
            })}
        </div>
   )
}
export default Availability