import { motion } from "framer-motion";
import type { Skill } from "@/data/skills";

interface SkillCardProps {
  skill: Skill;
  index: number;
}

const proficiencyColors = {
  expert: "bg-primary",
  advanced: "bg-accent",
  proficient: "bg-secondary",
};

const SkillCard = ({ skill, index }: SkillCardProps) => {
  return (
    <motion.div
      className="group relative p-4 rounded-xl bg-card border border-border hover:border-primary/30 transition-all cursor-pointer"
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ delay: index * 0.05, duration: 0.4 }}
      whileHover={{ y: -4 }}
    >
      <div className="flex items-start justify-between mb-2">
        <h4 className="font-heading font-semibold text-foreground group-hover:text-primary transition-colors">
          {skill.name}
        </h4>
        <span className={`w-2 h-2 rounded-full ${proficiencyColors[skill.proficiency]}`} />
      </div>
      <p className="text-sm text-muted-foreground leading-relaxed">
        {skill.description}
      </p>
    </motion.div>
  );
};

export default SkillCard;
