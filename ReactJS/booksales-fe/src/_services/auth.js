import { useJwt } from "react-jwt";
import { API } from "../_api";

export const login = async ({email, password}) => {
    try {
      const {data} = await API.post("/login", {email, password})
      return data  
    } catch (error) {
        console.log (error);
        throw error
    }
}

export const logout = async ({ token }) => {
    try {
      const {data} = await API.post("/logout", { token }, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("accessToken")}`
        }
      })
      localStorage.removeItem("accessToken");
      return data
    } catch (error) {
        console.log (error);
        throw error
    }
}

export const register = async ({ fullname, email, username, password }) => {
  try {
    const payload = { 
        name: `${fullname} (${username})`,
        email,
        password };
    const { data } = await API.post("/register", payload);

    return {
      success: true,
      message: "Register Success",
      data: data,
    };
  } catch (error) {
    return {
      success: false,
      message: error.response?.data?.message || "Register failed",
      data: null,
    };
  }
};







export const useDecodeToken = (token) => {
    const {decodedToken, isExpired} = useJwt(token)

    try {
      if (isExpired) {
        return{
            success: false,
            massage: "Token Expired",
            data: null
        }
      }  

       return{
            success: true,
            massage: "Token valid",
            data: decodedToken
        }

    } catch (error) {
        return{
            success: false,
            massage: error.massage,
            data: null
        }
        
    }
}