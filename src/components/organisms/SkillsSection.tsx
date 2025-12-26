import { motion } from "framer-motion";
import SectionHeading from "@/components/atoms/SectionHeading";
import SkillCard from "@/components/molecules/SkillCard";
import { skills, skillsContent, skillCategories } from "@/data/skills";
import { useState } from "react";

const SkillsSection = () => {
  const [activeCategory, setActiveCategory] = useState<string>("all");

  const filteredSkills = activeCategory === "all" 
    ? skills 
    : skills.filter((skill) => skill.category === activeCategory);

  return (
    <section className="py-24 bg-background">
      <div className="container mx-auto px-6">
        <SectionHeading
          title={skillsContent.heading}
          subtitle={skillsContent.subheading}
        />

        {/* Core Focus */}
        <motion.div
          className="mb-12 p-6 rounded-2xl bg-card border border-border"
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
        >
          <span className="text-sm text-primary font-medium">{skillsContent.coreFocusLabel}</span>
          <p className="mt-2 text-lg text-foreground">
            {skillsContent.coreFocus}
          </p>
        </motion.div>

        {/* Category Filter */}
        <div className="flex flex-wrap gap-3 mb-8">
          <motion.button
            onClick={() => setActiveCategory("all")}
            className={`px-4 py-2 rounded-full text-sm font-medium transition-colors ${
              activeCategory === "all"
                ? "bg-primary text-primary-foreground"
                : "bg-secondary text-muted-foreground hover:text-foreground"
            }`}
            whileHover={{ scale: 1.02 }}
            whileTap={{ scale: 0.98 }}
          >
            All
          </motion.button>
          {skillCategories.map((category) => (
            <motion.button
              key={category.key}
              onClick={() => setActiveCategory(category.key)}
              className={`px-4 py-2 rounded-full text-sm font-medium transition-colors ${
                activeCategory === category.key
                  ? "bg-primary text-primary-foreground"
                  : "bg-secondary text-muted-foreground hover:text-foreground"
              }`}
              whileHover={{ scale: 1.02 }}
              whileTap={{ scale: 0.98 }}
            >
              {category.label}
            </motion.button>
          ))}
        </div>

        {/* Skills Grid */}
        <motion.div 
          className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
          layout
        >
          {filteredSkills.map((skill, index) => (
            <SkillCard key={skill.name} skill={skill} index={index} />
          ))}
        </motion.div>
      </div>
    </section>
  );
};

export default SkillsSection;
