import { Heading } from "components/atoms/text";
import { ColorField } from "components/molecules/forms";
import React, { useEffect, useState } from "react";
import ColorPickerWidgetStyle from "./ColorPickerWidget.style";

const ColorPickerWidget = () => {
  const [errors, setErrors] = useState(null);
  const [color, setColor] = useState(null);

  const postColor = async () => {
    try {
      const data = {
        colorHexadecimal: color,
      };
      const response = await fetch("http://localhost:2345/color", {
        method: "POST",
        body: JSON.stringify(data),
        mode: "cors",
        credentials: "include",
      });
      if (response.status >= 200 && response.status <= 299) {
        const data = await response.json();
        console.log(data);
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
    </ColorPickerWidgetStyle>
  );
};

export default ColorPickerWidget;
