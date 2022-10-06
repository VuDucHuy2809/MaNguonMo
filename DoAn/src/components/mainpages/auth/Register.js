import React from 'react'
import { Link } from 'react-router-dom'

function Register() {
  return (
    <div>
        <div class="register">
                <div class="container">
                    <h3 class="animated wow zoomIn" data-wow-delay=".5s">Register Here</h3>
                    <p class="est animated wow zoomIn" data-wow-delay=".5s">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
                        deserunt mollit anim id est laborum.</p>
                    <div class="login-form-grids">
                        <h5 class="animated wow slideInUp" data-wow-delay=".5s">profile information</h5>
                        <form class="animated wow slideInUp" data-wow-delay=".5s">
                            <input type="text" placeholder="First Name..." required=" " />
                            <input type="text" placeholder="Last Name..." required=" " />
                        </form>
                        <div class="register-check-box animated wow slideInUp" data-wow-delay=".5s">
                            <div class="check">
                                <label class="checkbox"><input type="checkbox" name="checkbox"/><i> </i>Subscribe to Newsletter</label>
                            </div>
                        </div>
                        <h6 class="animated wow slideInUp" data-wow-delay=".5s">Login information</h6>
                        <form class="animated wow slideInUp" data-wow-delay=".5s">
                            <input type="email" placeholder="Email Address" required=" "/>
                            <input type="password" placeholder="Password" required=" " />
                            <input type="password" placeholder="Password Confirmation" required=" "/>
                            <div class="register-check-box">
                                <div class="check">
                                    <label class="checkbox"><input type="checkbox" name="checkbox"/><i> </i>I accept the terms and conditions</label>
                                </div>
                            </div>
                            <input type="submit" value="Register"/>
                        </form>
                    </div>
                    <div class="register-home animated wow slideInUp" data-wow-delay=".5s">
                        <Link to="/">Home</Link>
                    </div>
                </div>
            </div>
    </div>
  )
}

export default Register