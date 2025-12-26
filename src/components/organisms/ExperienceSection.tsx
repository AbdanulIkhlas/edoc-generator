import SectionHeading from "@/components/atoms/SectionHeading";
import ExperienceCard from "@/components/molecules/ExperienceCard";
import { experiences, experienceContent } from "@/data/experience";

const ExperienceSection = () => {
  return (
    <section className="py-24 bg-background">
      <div className="container mx-auto px-6">
        <SectionHeading
          title={experienceContent.heading}
          subtitle={experienceContent.subheading}
        />

        <div className="space-y-6">
          {experiences.map((experience, index) => (
            <ExperienceCard 
              key={experience.id} 
              experience={experience} 
              index={index} 
            />
          ))}
        </div>
      </div>
    </section>
  );
};

export default ExperienceSection;
