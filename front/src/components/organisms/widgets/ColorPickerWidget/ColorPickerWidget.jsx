import { Text } from "components/atoms/grouping";
import { Heading } from "components/atoms/text";
import { ColorField } from "components/molecules/forms";
import React, { useEffect, useState } from "react";
import ColorPickerWidgetStyle from "./ColorPickerWidget.style";

const ColorPickerWidget = () => {
  const [errors, setErrors] = useState(null);
  const [color, setColor] = useState(null);
  const [message, setMessage] = useState(null);

  const displaySuccessMessage = () => {
    if (!message) {
      return;
    }
    return <Text textAlign="center">{message}</Text>;
  };

  const postColor = async () => {
    try {
      const data = {
        colorHexadecimal: color,
      };
      const response = await fetch(":2345/color", {
        method: "POST",
        body: JSON.stringify(data),
        mode: "cors",
        credentials: "include",
      });
      if (response.status >= 200 && response.status <= 299) {
        const data = await response.json();
        setMessage(`La couleur de la lumière a été changée à ${data}`);
      } else throw new Error(response.statusText);
    } catch (err) {
      setErrors("La requête n'a pas fonctionné");
      console.warn(err);
    }
  };

  /**
   * @description Trigger the API call when the color changes
   */
  useEffect(() => {
    if (!color) {
      return;
    }
    postColor();
  }, [color]);

  return (
    <ColorPickerWidgetStyle>
      <Heading level="h1">Color Picker</Heading>
      <ColorField
        label="Choisissez la couleur de la lumière"
        color={color}
        setColor={setColor}
        error={errors}
      />
      {displaySuccessMessage()}
    </ColorPickerWidgetStyle>
  );
};

export default ColorPickerWidget;
