import { Card, Text } from "components/atoms/grouping";
import { PageTemplate } from "components/templates";
import React, { useEffect, useState } from "react";
import "./Profil.css";

const Profil = () => {
  const [userData, setUserData] = useState(null);
  const [userDataIsLoading, setUserDataIsLoading] = useState(true);
  // const [userData, setUserData] = useState([]);

  const [errors, setErrors] = useState(null);

  const getUser = async () => {
    setUserDataIsLoading(true);
    try {
      const response = await fetch(":2345/user", {
        method: "GET",
        mode: "cors",
        credentials: "include",
      });
      const data = await response.json();
      console.log(data);
      setUserData(data);
    } catch (err) {
      console.log(err);
    } finally {
      setUserDataIsLoading(false);
    }
  };

  useEffect(() => {
    if (userData) {
      return;
    }
    getUser();
  }, [userData]);

  // console.log(userData) ;

  const getUserRole = () => {
    if (userData?.role) {
      switch (userData.role) {
        case "User":
          return "Standard";
        default:
          return;
      }
    }
  };

  if (!userDataIsLoading && !userData) {
    return (
      <PageTemplate>
        <Card>
          <Text>Connectez-vous pour accéder au profil</Text>
        </Card>
      </PageTemplate>
    );
  }
  return (
    <PageTemplate>
      <div className="profil-component">
        <div className="profil-container">
          <h3> Espace Personnel</h3>
          <div>
            <p>
              {" "}
              <strong> Email</strong>
            </p>
            <p> {userData?.email}</p>
          </div>
          <div>
            <p>
              {" "}
              <strong>Type d'abonnement </strong>
            </p>
            <p> {getUserRole()}</p>
          </div>
          <div>
            <p>
              {" "}
              <strong>Date d'inscription </strong>
            </p>
            <p> {userData?.date_inscription}</p>
          </div>
        </div>
      </div>
    </PageTemplate>
  );
};

export default Profil;
