import { Text, Card } from "components/atoms/grouping";
import { Heading } from "components/atoms/text";
import { ColorPickerWidget } from "components/organisms/widgets";
// import { PageTemplate } from "components/templates";
import React from "react";

const HomePage = () => {
  return (
    
      <Card medium>
        <Heading size="xlarge" color="primary">
          RAITŌ ライト
        </Heading>
        <Text color="black">
          Avec Raito, nous vous proposons un outil complet de bien être et
          d’épanouissement via la musique, la lumière et la respiration.
        </Text>
        <Text color="black">
          Notre objectif est de vous offrir une bulle, pour prendre soin de
          vous. Nous vous proposons d’utiliser Raito aux moments clés de la
          journée que sont le réveil et l’endormissement, ainsi que dans les
          moments où vous souhaitez lâcher prise et vous détendre.
        </Text>
        <ColorPickerWidget />
      </Card>
  
  );
};

export default HomePage;
