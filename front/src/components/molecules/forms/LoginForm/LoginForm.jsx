import React from "react";
import Input from "components/atoms/forms/Input/Input";
import { useState } from "react";
import { ErrorText } from "components/molecules/forms";
import { Stack } from "components/atoms/grouping";
import "./LoginForm.css";
import { useNavigate } from "react-router-dom";
import BasicButton from "components/molecules/clickable/BasicButton/BasicButton";

const LoginForm = () => {
  const [data, setData] = useState({});

  const [errors, setErrors] = useState(null);

  const [successRegister, setSuccessRegister] = useState(false);
  const [successLogin, setSuccessLogin] = useState(false);
  const navigate = useNavigate();

  const handleChange = (e) => {
    const key = e.target.name;
    const value = e.target.value;
    setData({ ...data, [key]: value });
  };

  /**
   * @description API call to login
   */
  const login = async () => {
    setSuccessRegister(false);
    const encodedData = window.btoa(`${data.email}:${data.password}`);
    const headers = new Headers({
      Authorization: `Basic ${encodedData}`,
      //   "Content-Type": "application/x-www-form-urlencoded",
    });
    console.log(headers);
    try {
      const response = await fetch(":2345/login", {
        method: "POST",
        mode: "cors",
        credentials: "include",
        headers: headers,
      });
      if (response.status >= 200 && response.status <= 299) {
        const data = await response.json();
        setSuccessLogin(true);
        setErrors("");
        navigate("/profil");




      } else throw new Error(response.statusText);
      setErrors("");
    } catch (err) {
      setErrors("La requête n'a pas fonctionné");
      setSuccessLogin(false);
      console.warn(err);
    }
  };

  const register = async () => {
    setSuccessLogin(false);

    const encodedData = window.btoa(`${data.email}:${data.password}`);
    const headers = new Headers({
      Authorization: `Basic ${encodedData}`,
    });
    console.log(headers);
    try {
      const response = await fetch("http://localhost:2345/register", {
        method: "POST",
        mode: "cors",
        credentials: "include",
        headers: headers,
      });
      if (response.status >= 200 && response.status <= 299) {
        const data = await response.json();
        console.log(data);
        setSuccessRegister(true);
        setErrors("");
        navigate("/profil");


      } else throw new Error(response.statusText);
      // setSuccessRegister(false) ;
      setErrors("");
    } catch (err) {
      setErrors("La requête n'a pas fonctionné");
      console.warn(err);
      setSuccessRegister(false);
    }
  };

  return (
    <div>
      <p>Email</p>
      <Input
        type="email"
        placeholder="email"
        name="email"
        onChange={(e) => handleChange(e)}
      />

      <p>Mot de passe</p>
      <Input
        name="password"
        type="password"
        placeholder="password"
        onChange={(e) => handleChange(e)}
      />

      <ErrorText error={errors} />

      <div className={successLogin ? "success-login" : "fail"}>
        <span> Connexion réussie </span>
      </div>

      <div className={successRegister ? "success-register" : "fail"}>
        <span> Enregistrement réussi </span>
      </div>

      <Stack>
        <BasicButton primary onClick={() => login()}>
          Se Connecter
        </BasicButton>
        <BasicButton onClick={() => register()}>S'inscrire</BasicButton>
      </Stack>
    </div>
  );
};

export default LoginForm;
